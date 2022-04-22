@component('mail::message')
# New application!

You have received a new application for your job posting from the DAMA job board.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
