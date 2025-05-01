<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Display Vacation Status -->
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Vacation Status</h3>

                        @foreach($vacations as $vacation)
                            <div class="flex items-center mt-2">
                                <div class="mr-2">
                                    @if($vacation->Status == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($vacation->Status == 0)
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </div>
                                <div>
                                    <strong>{{ $vacation->employee->username }}</strong> - {{ $vacation->Start_Date }} to {{ $vacation->End_Date }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Display Permission Status -->
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Permission Status</h3>

                        @foreach($permissions as $permission)
                            <div class="flex items-center mt-2">
                                <div class="mr-2">
                                    @if($permission->Status == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($permission->Status == 0)
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </div>
                                <div>
                                    <strong>{{ $permission->employee->username }}</strong> - {{ $permission->StartDate }} to {{ $permission->EndDate }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
