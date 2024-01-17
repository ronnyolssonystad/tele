<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VCF to JSON Converter</title>
</head>
<body>
    <input type="file" id="vcfFileInput" accept=".vcf">
    <button onclick="convertVCFtoJSON()">Convert</button>
    <pre id="jsonOutput"></pre>

    <script>
        function convertVCFtoJSON() {
            const fileInput = document.getElementById('vcfFileInput');
            const jsonOutput = document.getElementById('jsonOutput');

            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const vcfContent = e.target.result;

                    const jsonData = parseVCF(vcfContent);
                    const jsonString = JSON.stringify(jsonData, null, 2);

                    jsonOutput.textContent = jsonString;
                };

                reader.readAsText(file);
            } else {
                alert('Please select a VCF file.');
            }
        }

        function parseVCF(vcfContent) {
            const vcfLines = vcfContent.split(/\r?\n/);
            const jsonData = [];

            let currentContact = {};

            vcfLines.forEach(line => {
                if (line.startsWith('BEGIN:VCARD')) {
                    currentContact = {};
                } else if (line.startsWith('END:VCARD')) {
                    jsonData.push(currentContact);
                } else {
                    const [field, value] = line.split(':');
                    if (field && value) {
                        if (field === 'N') {
                            currentContact['name'] = value;
                        } else if (field === 'FN') {
                            currentContact['ename'] = value;
                        } else if (field.startsWith('TEL')) {
                            currentContact['nr'] = value;
                        } else if (field.startsWith('EMAIL') ) {
                            currentContact['email'] = value;
                        } 
                    }
                }
            });

            sendJsonToPhp (jsonData);
        }
        function sendJsonToPhp(jsonData) {
            // Specify the PHP endpoint
            const phpEndpoint = 'save.php';

            // Create a new FormData object
            const formData = new FormData();

            // Convert JSON data to a string and append it to the FormData
            formData.append('jsonData', JSON.stringify(jsonData));

            // Use the Fetch API to send the data to the PHP script
            fetch(phpEndpoint, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Response from PHP:', data);
                // Handle the response from PHP as needed
            })
            .catch(error => {
                console.error('Error sending data to PHP:', error);
            });
        }
    </script>
</body>
</html>
