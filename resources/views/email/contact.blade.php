<x-mail::message>
# {{ $data['subject'] }}

{!! $data['message'] !!}


From, {{ $data['email'] }}
</x-mail::message>
