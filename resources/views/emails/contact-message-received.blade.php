<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #0f172a; line-height: 1.5;">
    <h2 style="margin: 0 0 12px;">New Contact Message</h2>

    <p style="margin: 0 0 8px;"><strong>Name:</strong> {{ $contact->name }}</p>
    <p style="margin: 0 0 8px;"><strong>Email:</strong> {{ $contact->email }}</p>
    <p style="margin: 0 0 8px;"><strong>Received:</strong> {{ $contact->created_at?->format('M d, Y h:i A') }}</p>

    <hr style="margin: 16px 0; border: 0; border-top: 1px solid #cbd5e1;">

    <p style="margin: 0 0 8px;"><strong>Message</strong></p>
    <p style="white-space: pre-line; margin: 0;">{{ $contact->message }}</p>
</body>
</html>

