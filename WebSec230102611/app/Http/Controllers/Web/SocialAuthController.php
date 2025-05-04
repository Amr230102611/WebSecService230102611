<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;
use Exception;

class SocialAuthController extends Controller
{
    /**
     * Redirect to social provider
     */
    public function redirectToProvider($provider)
    {
        // Validate the provider to prevent passing arbitrary values
        if (!in_array($provider, ['google', 'github', 'linkedin'])) {
            return redirect()->route('login')->withErrors('Invalid social provider');
        }
        
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from social provider
     */
    public function handleProviderCallback($provider)
    {
        try {
            // Validate the provider to prevent passing arbitrary values
            if (!in_array($provider, ['google', 'github', 'linkedin'])) {
                return redirect()->route('login')->withErrors('Invalid social provider');
            }
            
            $socialUser = Socialite::driver($provider)->user();
            
            // Find user by provider and provider_id or by email
            $user = User::where('provider', $provider)
                        ->where('provider_id', $socialUser->getId())
                        ->first();
            
            if (!$user) {
                // Check if user with same email exists
                $user = User::where('email', $socialUser->getEmail())->first();
                
                if (!$user) {
                    // Create new user if doesn't exist
                    $user = User::create([
                        'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                        'email' => $socialUser->getEmail(),
                        'password' => bcrypt(bin2hex(random_bytes(16))), // Secure random password
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'credit' => 0.00,
                    ]);
                    
                    // Assign Customer role if it exists
                    try {
                        $customerRole = Role::where('name', 'Customer')->first();
                        if ($customerRole) {
                            $user->assignRole($customerRole);
                        }
                    } catch(\Exception $e) {
                        // Log error but continue - don't stop login if role assignment fails
                        \Log::error("Failed to assign Customer role: " . $e->getMessage());
                    }
                } else {
                    // Update existing user with provider details
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                    ]);
                }
            }
            
            // Login user
            Auth::login($user);
            
            return redirect('/');
            
        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Social login error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors('An error occurred during social login. Please try again.');
        }
    }
}
