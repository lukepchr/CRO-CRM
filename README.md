# CRO
Customer Relationships Management tool for sales teams and account managers to store and share information regarding their business contacts. Built using PHP, MySQL, Bootstrap and JavaScript. It can be accessed by multiple users with different passwords and is secured against SQL-injection attacks.

### The core functionality is already working:
- Add, view, modify and remove company profiles with contact details, notes and employees
- Add, view, modify and remove employee profiles under these companies
- Search for accounts and people
- Companies are identified by an account code (8 letters/numbers) which is usually handy for invoicing purposes, although when adding a new employee, company can be picked by a name from a list.
- Post "global" messages to appear in the main dashboard.
- Post messages relating companies that will appear both on the company profile and in the dashboard with a link to the company profile
- Consistent notifications in JS/jQuery/CSS3 to inform of successful operations (or not) :) 
#### Security
- Password-protected
- SQL Injection-proof

### Structure:

#### Main Pages:
- index.php - the dashboard with the shout box and "newsfeed", all the important info / stats will go here later.
- login.php is asking for username and password, comparing them with the database record and setting up a session. Other pages check a variable for access control.
- all_organisations.php - summary of all organisations sorted alphabetically; edit/delete. After changing a record, receives the request in POST/GET and makes change to the MySQL database.
- all_people.php - summary of all people alphabetically; edit/delete. After changing a record, receives the request in POST/GET and makes change to the MySQL database.
- organisation_profile.php is a little dashboard for each organisation
- results.php is the list of companies or people who matched the search query.

#### Partials:
- top.php - the logo and menu to be added on top of each page.
- add_organisation.php - forms to add new company
- add_person.php - forms to add new person; That's a partial to go into `all_people.php`
- edit_organisation.php - edit existing organisation, retrieving the old record first to pre-fill the fields
- edit_person.php - edit existing employee, retrieving the old record first to pre-fill the fields.

#### Under the hood:
- header.php libraries and meta tags to be included on the top of each page
- database.php - the mySQLi connection variables. I didn't include it in this repository for obvious reasons, so please see exact template below:

```
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "mydb";

$connection = new mysqli ($servername, $username, $password, $dbname);
if ($connection->connect_error){
die("connection failed: " . $connection->connect_error);
}
```


### Still to do:
- script injection-proofing
- pages layout
- dashboard
- personal to-do list for each user; the tasks would be linked to companies to show both on dashboard and under their accounts.
