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
            <div class="form-container">
                <h2 class="form-header">Request Vacation</h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('vacation.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST">

                    <div class="mb-3">
                        <label class="form-label">Vacation Type:</label>
                        <select name="VacationTypeID" class="form-control @error('VacationTypeID') is-invalid @enderror" required>
                            <option value="">Select Vacation Type</option>
                            @foreach($vacationTypes as $type)
                                <option value="{{ $type->id }}" {{ old('VacationTypeID') == $type->id ? 'selected' : '' }}>
                                    {{ $type->TypeName }} - {{ $type->Description }}
                                </option>
                            @endforeach
                        </select>
                        @error('VacationTypeID')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Start Date:</label>
                        <input type="date" name="Start_Date" class="form-control @error('Start_Date') is-invalid @enderror" 
                               required min="{{ date('Y-m-d') }}" value="{{ old('Start_Date') }}">
                        @error('Start_Date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date:</label>
                        <input type="date" name="End_Date" class="form-control @error('End_Date') is-invalid @enderror" 
                               required min="{{ date('Y-m-d') }}" value="{{ old('End_Date') }}">
                        @error('End_Date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Duration (days):</label>

                        <input type="number" name="Duration" class="form-control @error('Duration') is-invalid @enderror" 
                               required min="1" value="{{ old('Duration') }}">
                        @error('Duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Comments:</label>
                        <textarea name="Comments" class="form-control @error('Comments') is-invalid @enderror" 
                                  rows="3" maxlength="500">{{ old('Comments') }}</textarea>
                        @error('Comments')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit Vacation Request</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-app-layout>
