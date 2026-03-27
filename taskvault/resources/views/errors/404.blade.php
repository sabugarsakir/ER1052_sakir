<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center justify-center min-h-[400px]">
                    <h1 class="text-6xl font-bold text-red-500 mb-4">404</h1>
                    <h2 class="text-2xl font-semibold mb-2">Task Not Found</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">{{ $message ?? 'The task you are looking for does not exist.' }}</p>
                    
                    <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Return to Tasks
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
