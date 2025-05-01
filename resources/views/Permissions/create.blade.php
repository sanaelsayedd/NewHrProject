<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Permission') }}
        </h2>
    </x-slot>

    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
       
    @endpush

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="form-container">
                <h2 class="form-header">Request Permission</h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">&times;</button>
                    </div>
                @endif

                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Permission Type</label>
                        <select name="Permission_Type_id" class="form-control @error('Permission_Type_id') is-invalid @enderror" required>
                            <option value="">Select Permission Type</option>
                            @foreach($PermissionTypes as $type)
                                <option value="{{ $type->id }}" {{ old('Permission_Type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->TypeName }}
                                </option>
                            @endforeach
                        </select>
                        @error('Permission_Type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="StartDate" class="form-control @error('StartDate') is-invalid @enderror"
                               value="{{ old('StartDate') }}" required min="{{ date('Y-m-d') }}">
                        @error('StartDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">End Date</label>
                        <input type="date" name="EndDate" class="form-control @error('EndDate') is-invalid @enderror"
                               value="{{ old('EndDate') }}" required min="{{ date('Y-m-d') }}">
                        @error('EndDate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            Submit Permission Request
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('dashboard') }}'">
                            Back to Dashboard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Auto-dismiss alerts after 5 seconds
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }, 5000);
                });

                // Add subtle animations to form elements on focus
                const formControls = document.querySelectorAll('.form-control');
                formControls.forEach(control => {
                    control.addEventListener('focus', () => {
                        control.parentElement.style.transform = 'translateY(-2px)';
                    });
                    control.addEventListener('blur', () => {
                        control.parentElement.style.transform = '';
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>