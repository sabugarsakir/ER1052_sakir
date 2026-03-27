<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Alpine.js wrapper for staggard entrance animations -->
    <div class="py-12" x-data="{ showStats: false, showRecent: false }" x-init="setTimeout(() => showStats = true, 150); setTimeout(() => showRecent = true, 400);">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Statistics Grid -->
            <div 
                x-show="showStats" 
                x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
                style="display: none;"
            >
                
                <!-- Total Tasks Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl cursor-default">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider mb-1">Total Tasks</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['total'] }}</div>
                </div>

                <!-- Pending Tasks Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-400 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl cursor-default">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider mb-1">Pending</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['pending'] }}</div>
                </div>

                <!-- In Progress Tasks Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl cursor-default">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider mb-1">In Progress</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['in_progress'] }}</div>
                </div>

                <!-- Completed Tasks Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl cursor-default">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wider mb-1">Completed</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stats['completed'] }}</div>
                </div>

            </div>

            <!-- Recent Activity Section -->
            <div 
                x-show="showRecent" 
                x-transition:enter="transition ease-out duration-700 transform"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                style="display: none;"
            >
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Activity</h3>
                    <a href="{{ route('tasks.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium transition-colors">
                        View all tasks &rarr;
                    </a>
                </div>
                
                <div class="p-0">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($recentTasks as $task)
                            <li class="p-6 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-200 group">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('tasks.show', $task) }}" class="block focus:outline-none">
                                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 truncate group-hover:text-indigo-800 dark:group-hover:text-indigo-300 transition-colors">
                                                {{ $task->title }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate mt-1">
                                                {{ $task->description ? \Illuminate\Support\Str::limit($task->description, 60) : 'No description.' }}
                                            </p>
                                        </a>
                                    </div>
                                    <div class="ml-4 shrink-0 flex flex-col items-end">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full mb-1
                                            {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : ($task->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                        <span class="text-xs text-gray-400 dark:text-gray-500">
                                            {{ $task->updated_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="p-6 text-center text-gray-500 dark:text-gray-400">
                                You haven't created any tasks yet. <a href="{{ route('tasks.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Get started here!</a>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
