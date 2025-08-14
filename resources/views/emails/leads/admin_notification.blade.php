<!doctype html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, Helvetica, sans-serif; line-height:1.6; color:#222;">
  <h2>New Enquiry (Pending): {{ $tourTitle }}</h2>
  <p><strong>Ref:</strong> {{ $ref }}</p>
  <p style="margin:0;"><strong>Status:</strong> Pending — requires ops confirmation (lead time {{ $leadDays ?? 2 }} day(s))</p>

  <h3>Customer</h3>
  <p>
    <strong>Name:</strong> {{ $lead->name }}<br>
    <strong>Email:</strong> {{ $lead->email }}<br>
    @if(!empty($lead->phone))
    <strong>Phone:</strong> {{ $lead->phone }}<br>
    @endif
  </p>

  <h3>Trip Details</h3>
  <p>
    <strong>Start date:</strong> {{ \Illuminate\Support\Carbon::parse($lead->start_date)->toFormattedDateString() }}<br>
    <strong>Adults:</strong> {{ $lead->adults }} |
    <strong>Children:</strong> {{ $lead->children }}
  </p>

  @if(!empty($lead->message))
  <h3>Message</h3>
  <p>{{ $lead->message }}</p>
  @endif

  <hr>
  <p style="font-size:12px;color:#666;">
    Replying to this email will reach the customer directly.
  </p>
</body>
</html>
