<div class="footer text-muted text-center{{ !empty($class) ? " {$class}" : ''  }}">
    &copy; {{ date('Y') }} <a href="{{ route('forms.index') }}">{{ config('app.name') }}</a> by <a href="{{ config('custom.app.owner.url') }}" target="_blank">{{ config('custom.app.owner.name') }}</a>
</div>
