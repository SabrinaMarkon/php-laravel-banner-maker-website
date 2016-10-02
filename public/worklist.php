- paypal button code + IPN for products and licenses
- bulk mailer
- member login and menu control
- admin login control
- banner image collection
- banner page
- banner color palette
- settings and member session variables!!!
-email login
- referid isn't tracked..add to session somehow
- files with temporary default stuff:
    MembersController.php (members area) - has lucas test email
    MailTrait.php (not sure what to do with this for sure)
    MembersController.php (member area) has    $member = Member::where('userid', '=', 'sabrina')->first(); //fix.
    MailsController.php (member area) has $contents = Mail::where('userid', 'admin')->orderBy('subject', 'asc')->get(); // change 'admin' to userid when I get that working.

1 - figure out how to queue mail in the background and send
2 - figure out how to send verification emails
3 - figure out how to send forgot password emails

4 - site variables and session variables


