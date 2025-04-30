<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Vacation') }}
        </h2>
    </x-slot>

    @push('styles')
        <!-- Add this section in your layout if not already present: @stack('styles') -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @endpush

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('vacation.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="employee_id" value="{{ auth()->user()->id }}">

                    <div class="mb-3">
                        <label class="form-label">Vacation Type ID:</label>
                        <input type="number" name="VacationTypeID" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Start Date:</label>
                        <input type="date" name="Start_Date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date:</label>
                        <input type="date" name="End_Date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Duration (days):</label>
                        <input type="number" name="Duration" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Comments:</label>
                        <textarea name="Comments" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Vacation Request</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
