- paypal button code + IPN for products and licenses
- bulk mailer
- member login and menu control
- admin login control
- member/admin session variables!!!
-email login - code to send the email only now!!! same for admin and member
- referid isn't tracked..add to session somehow - change to cookies because I hate it.

- banner image collection
- banner page
- banner color palette


- files with temporary default stuff:
    MembersController.php (members area) - has lucas test email
    MailTrait.php (not sure what to do with this for sure)
    MembersController.php (member area) has    $member = Member::where('userid', '=', 'sabrina')->first(); //fix.
    MailsController.php (member area) has $contents = Mail::where('userid', 'admin')->orderBy('subject', 'asc')->get(); // change 'admin' to userid when I get that working.
BuildersTrait.php - has default sabrina

1 - figure out how to queue mail in the background and send
2 - figure out how to send verification emails
3 - figure out how to send forgot password emails

4 - session variables


