c:\Users\bhuva\Downloads\bubu-w9id-a7e29f87c53a.json


<?php
require 'vendor/autoload.php'; // This loads the Google Cloud library

use Google\Cloud\Storage\StorageClient;

// Your JSON file (inside project folder)
$keyFilePath = __DIR__ . '/bubu-w9id-a7e29f87c53a.json';

// Create Google Storage Client
$storage = new StorageClient([
    'keyFilePath' => $keyFilePath
]);

// List all buckets
try {
    $buckets = $storage->buckets();
    echo "<h2>My Buckets:</h2><ul>";
    foreach ($buckets as $bucket) {
        echo "<li>" . $bucket->name() . "</li>";
    }
    echo "</ul>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>

<?php
// Step 1: Set the environment variable for authentication
putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\\xampp\\htdocs\\book_website\\project\\bubu-w9id-a7e29f87c53a.json');  // Use double backslashes or forward slashes

// Step 2: Load the Dialogflow client library
require 'vendor/autoload.php';

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;

// Step 3: Create a session client (authenticated via the service account key)
$sessionClient = new SessionsClient();

// Dialogflow project details
$projectId = 'your-google-project-id';  // Replace with your Google Cloud project ID
$sessionId = uniqid();  // Unique session ID for each interaction
$session = $sessionClient->sessionName($projectId, $sessionId);

// Step 4: Send a text query to Dialogflow
$textInput = new TextInput();
$textInput->setText("Hello, chatbot!");
$textInput->setLanguageCode('en-US');

$queryInput = new QueryInput();
$queryInput->setText($textInput);

$response = $sessionClient->detectIntent($session, $queryInput);

// Step 5: Print the response
echo "Dialogflow Response: " . $response->getQueryResult()->getFulfillmentText();
?>




