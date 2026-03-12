Setup Instructions for Eclipse Contact Form

1. Requirements:
   - PHP installed on your system
   - MySQL server running
   - A database named 'eclipse_crm' with a table 'contacts'

2. Create the 'contacts' table using the following SQL:

CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  company VARCHAR(255),
  message TEXT,
  submittedAt DATETIME
);

3. Update 'submit-contact.php':
   - Replace 'your_password' with your actual MySQL password

4. Run Locally:
   - Place all files in a folder (e.g., 'eclipse-contact-form')
   - Start a local PHP server:
     php -S localhost:8000
   - Visit http://localhost:8000/contact.html in your browser

5. Test the form:
   - Fill out the form and click Submit
   - Check your database to confirm the entry was saved
