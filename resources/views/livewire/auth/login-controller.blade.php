{{-- <x-slot title="login"></x-slot> --}}
<div>
    <div class="row">
        <div class="col-md-12 p-4">
            {{-- <a href="{{ route('passport.login') }}">
                <button class="btn bg-red-400 text-white"> login rmutr account</button>
            </a> --}}
            <a href="{{ route('passport.login.api') }}">
                <button class="btn bg-red-400 text-white"> login rmutr account</button>
            </a>
        </div>
        <div class="col-md-12 p-4">
            <a href="{{ route('google.login.api') }}">
                <button class="btn bg-red-700 text-white"> login google account</button>
            </a>
        </div>
        <div class="col-md-12 p-4">
            <a href="{{ route('facebook.login.api') }}">
                <button class="btn bg-blue-500 text-white"> login faccebook </button>
            </a>
        </div>
    </div>
</div>
