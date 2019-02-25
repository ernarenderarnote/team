<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<title>Mail Format</title>
	</head>
	<body>
		<table style="width: 591.0px;margin: 0.0pt auto;font-family: verdana;font-size: 13.0px;color: rgb(107,109,110);line-height: 20.0px;">
		   <tbody>
			  <tr>
				 <td style="min-height: 103.0px;text-align: center;"><img src="{{ asset('/images/logo.png') }}" height="102" width="388"><br>​<br></td>
			  </tr>
			  <tr>
				 <td style="min-height: 3.0px;font-size: 0.0px;">&nbsp;</td>
			  </tr>
			  <tr>
				 <td style="font-weight: bold;font-size: 17.0px;color: rgb(0,86,150);vertical-align: bottom;min-height: 23.0px;letter-spacing: -0.3px;">Hello <a href="mailto:{{ $user->email}}" target="_blank">{{ $user->email }} </a>!</td>
			  </tr>
			  <tr>
				 <td>
					<p>We received a request to change your account's password, to proceed please follow the link below:</p>
					<p><a href="{{ route('account.setup', $token) }}" target="_blank">Change my password</a></p>
					<p>If you did not intend to change your password, please ignore this email.</p>
					<p>Your password will not be changed until you access the link above and change it.</p>
				 </td>
			  </tr>
			  <tr>
				 <td style="vertical-align: bottom;min-height: 59.0px;">Have any questions or require assistance? Visit the Yotpo Help Center at <a href="mailto:support@teamedu.com" target="_blank">support@team.education</a></td>
			  </tr>
			  <tr>
				 <td style="text-align: right;min-height: 33.0px;vertical-align: bottom;">The Team.Education Team</td>
			  </tr>
			  <tr>
				 <td style="min-height: 3.0px;font-size: 0.0px;">&nbsp;</td>
			  </tr>
			  <tr>
				 <td style="text-align: right;">       <br></td>
			  </tr>
			  <tr>
				 <td style="font-size: 11.0px;color: rgb(156,157,158);line-height: 16.0px;">You are receiving this email because you registered at Team.Education and agreed to receive email from us regarding new features, events and special offers from Team.Education. If you wish to be unsubscribed from receiving these emails please <a style="font-style: italic;color: rgb(0,86,150);text-decoration: none;" href="#" target="_blank">click here</a>.</td>
			  </tr>
		   </tbody>
		</table>
	</body>
</html>