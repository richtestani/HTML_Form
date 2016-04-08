# HTML_Form
A simple PHP HTML form generation class.

Build form inputs quickly in PHP with this this class.

#Example:

$form = new RichTestani\HTML_Form\Form('/action.php', 'post');

//new Div wrapper
$form->addDiv('row', 'login-form');

//add some text fields
$form->insertInput('text', 'username', '', array('placeholder'=>'username'));
$form->setLabel('Username', 'username');

$form->insertInput('text', 'password', '', array('placeholder'=>'password'));
$form->setLabel('Password', 'password');

$form->endDiv();

$final = $form->get();

echo $final;
