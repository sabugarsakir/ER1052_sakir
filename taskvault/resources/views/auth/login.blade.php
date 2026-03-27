<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-2">Welcome Back</h2>
        <p class="text-sm text-gray-400">Sign in to your TaskVault account to continue.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
            <input id="email" class="mt-2 block w-full rounded-lg bg-gray-900/50 border border-gray-600/50 focus:border-indigo-500 focus:ring-indigo-500 text-white placeholder-gray-500 transition-colors duration-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" class="mt-2 block w-full rounded-lg bg-gray-900/50 border border-gray-600/50 focus:border-indigo-500 focus:ring-indigo-500 text-white placeholder-gray-500 transition-colors duration-200" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="h-4 w-4 rounded bg-gray-900/50 border-gray-600 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-gray-800" name="remember">
            <label for="remember_me" class="ml-2 block text-sm text-gray-400">
                Remember me
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-600 hover:via-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-900 transform transition-all hover:scale-[1.02] active:scale-95">
                Log in
            </button>
        </div>
        
        <p class="text-center text-sm text-gray-400 mt-6">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-medium text-indigo-400 hover:text-indigo-300 transition-colors">Sign up</a>
        </p>
    </form>
</x-guest-layout>
