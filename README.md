# CRO
CRO is a CRM system or in this case, Customer Relationships Organiser application for sales teams or account managers to store information regarding their work with customers.

This is my first Full Stack project. I decided to use PHP, mySQL and Bootstrap. I run it on Raspberry Pi accessed through SSH and FTP to resemble real deployment environment although when it's fully finished, I wish to make it available to others and e.g. include installer as in CMS systems and nice documentation.

###The core functionality is already working:
- Add, view, modify and remove company profiles with contact details, notes and employees
- Add, view, modify and remove employee profiles under these companies
- Companies are identified by an account code (8 letters/numbers) which is usually handy for invoicing purposes, although when adding a new employee, company can be picked by a name from a list.
- Post "global" messages to appear in the main dashboard.
- Post messages relating companies that will appear both on the company profile and in the dashboard with a link to the company profile

###Still to do:
- user account required to login
- various levels of permissions
- layout of the pages, especially a more functional dashboard
- search
- personal to-do list for each user; the tasks would be linked to companies to show both on dashboard and under their accounts.

###Rough structure:

- header.php is a partial; the top of each page with all the head stuff, Bootstrap includes, logo and menu also a little `SERVER_SOFTWARE` badge to make me happy when I see it. (don't ask).
- database.php - variables regarding the mySQLi connection

- index.php - the dashboard with the shoutbox and "newsfeed", all the important info / stats will go here later.
- add_organisation.php - forms to add new company
- add_person.php - forms to add new person
- edit_organisation.php - edit existing organisation, retrieving the old record first to pre-fill the fields
- edit_person.php - edit existing employee, retrieving the old record first to pre-fill the fields
- person_changed.php - after editing a person => a page to receive POST/GET requests and turn them into mySQLi queries
- org_changes.php - after editing a company => a page to receive POST/GET requests and turn them into mySQLi queries
- all_organisations.php - summary of all organisations sorted alphabetically; edit/delete
- all_people.php - sumary of all people alphabetically; edit/delete
- organisation_profile.php is a little dashboard for each organisation

####The file database.php was not included, this is what it looks like:

```
$servername = "127.0.0.1";
$username = "root";
$password = $somepassword;
$dbname = "mydb";

$connection = new mysqli ($servername, $username, $password, $dbname);
if ($connection->connect_error){
die("connection failed: " . $connection->connect_error);
}
```
