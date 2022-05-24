{{ $data->product_name }} ({{ $data->product_url }})

******************
Welcome, {{$data->name}}!
******************

Thanks for trying {{$data->product_name}}. We’re thrilled to have you on board.

To get the most out of {{$data->product_name}}, do this primary next step:

Do this Next ( {{ $data->action_url }} )

For reference, here's your login information:

Login Page: {{$data->login_url}}
Username: {{$data->username}}

If you have any questions, feel free to email our customer success team ( {{ $data->support_email }} ).

Thanks,
{{$data->sender_name}} and the {{$data->product_name}} Team

If you’re having trouble with the button above, copy and paste the URL below into your web browser.

{{$data->action_url}}


© 2021 {{ $data->product_name }}. All rights reserved.

{{ $data->company_name }}
{{ $data->company_address }}
