<div class="my-2">
    @if (session('success'))
        <p class="fs-5 text-success">{{ session('success') }}</p>
    @endif
    @if (session('danger'))
        <p class="fs-5 text-danger">{{ session('danger') }}</p>
    @endif
</div>
