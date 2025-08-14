@component('mail::message')
# New contact message

**Ref:** {{ $ref }}

- **Name:** {{ $data['name'] }}
- **Email:** {{ $data['email'] }}
- **Phone:** {{ $data['phone'] ?? '-' }}

**Message:**  
{{ $data['message'] }}

@endcomponent
