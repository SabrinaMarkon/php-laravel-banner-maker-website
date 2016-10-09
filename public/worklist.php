- paypal button code + IPN for products and licenses
- bulk mailer

- member/admin session variables!!! - so irritating..weak in this. Seemed to work with the Providers\ComposerServiceProvider but didn't get passed to verification emails (domain, from field, etc.) So
created GlobalConfig middleware which I got to work. Both exist though still.

-email login - code to send the email only now!!! same for admin and member (adminlogincontroller, membercontroller)

- referid isn't tracked properly I hate how this works right now. Awkward.

- banner image collection
- banner page
- banner color palette - css circles <div style="circle with color" id="colorvalue"></div>


- files with temporary default stuff:
    #MembersController.php (members area) - has lucas test email
    MailTrait.php (not sure what to do with this for sure)
   # MembersController.php (member area) has    $member = Member::where('userid', '=', 'sabrina')->first(); //fix.
    #MailsController.php (member area) has $contents = Mail::where('userid', 'admin')->orderBy('subject', 'asc')->get(); // change 'admin' to userid when I get that working.
#BuildersTrait.php - has default sabrina
#promote.blade.php - has ADD AFFILIATE URL CODE HERE instead of the actual affiliate code.
# PagesController - promote function has $referrals = Member::where('referid', '=', 'SHOULD BE USERID')->get();

1 - figure out how to queue mail in the background and send
2 - figure out how to send verification emails
3 - figure out how to send forgot password emails

4 - session variables


