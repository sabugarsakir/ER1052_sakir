<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $task->title }}
            </h2>
            @if(!isset($shared) || !$shared)
            <div>
                <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('tasks.share', $task->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition mr-2" target="_blank">
                    Share Link (Signed URL)
                </a>
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                    Back to List
                </a>
            </div>
            @else
            <span class="text-sm text-gray-400">View-Only Shared Mode</span>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">Task Details</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 leading-relaxed whitespace-pre-line">
                            {{ $task->description ?: 'No description provided.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mt-8 bg-gray-50 dark:bg-gray-900 p-4 rounded-md">
                        <div>
                            <span class="font-medium text-gray-500 dark:text-gray-400">Status:</span>
                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : ($task->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-500 dark:text-gray-400">Created:</span>
                            <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $task->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-500 dark:text-gray-400">Last Updated:</span>
                            <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $task->updated_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-500 dark:text-gray-400">Owner:</span>
                            <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $task->user->name }}</span>
                        </div>
                    </div>

                    @if(!isset($shared) || !$shared)
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Edit Task
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-red-300 dark:border-red-500 rounded-md font-semibold text-xs text-red-700 dark:text-red-500 uppercase tracking-widest shadow-sm hover:bg-red-50 dark:hover:bg-red-900/10 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Delete Task
                            </button>
                        </form>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
