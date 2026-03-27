<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-white mb-2">Create an Account</h2>
        <p class="text-sm text-gray-400">Join TaskVault to manage your tasks efficiently.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
            <input id="name" class="mt-2 block w-full rounded-lg bg-gray-900/50 border border-gray-600/50 focus:border-indigo-500 focus:ring-indigo-500 text-white placeholder-gray-500 transition-colors duration-200" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
            <input id="email" class="mt-2 block w-full rounded-lg bg-gray-900/50 border border-gray-600/50 focus:border-indigo-500 focus:ring-indigo-500 text-white placeholder-gray-500 transition-colors duration-200" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <input id="password" class="mt-2 block w-full rounded-lg bg-gray-900/50 border border-gray-600/50 focus:border-indigo-500 focus:ring-indigo-500 text-white placeholder-gray-500 transition-colors duration-200" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
            <input id="password_confirmation" class="mt-2 block w-full rounded-lg bg-gray-900/50 border border-gray-600/50 focus:border-indigo-500 focus:ring-indigo-500 text-white placeholder-gray-500 transition-colors duration-200" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="pt-2 flex items-center justify-between">
            <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors">
                Already registered?
            </a>

            <button type="submit" class="flex justify-center py-2.5 px-6 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-600 hover:via-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-900 transform transition-all hover:scale-[1.02] active:scale-95">
                Register
            </button>
        </div>
    </form>
</x-guest-layout>
