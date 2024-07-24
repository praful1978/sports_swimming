 
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const username = document.getElementById('username').value;
            if (username) {
                fetch(`fetch_file.php?user_name=${encodeURIComponent(username)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.file_name) {
                            const filePathadhar = `../localhost/php/fitness_form/${data.file_name}`; // Update the path accordingly
                            const filePathfitness = `../localhost/php/adhar_card/${data.file_name}`; // Update the path accordingly
                            // Create an anchor element
                            const link = document.createElement('a');
                            link.href = filePath;

                            // Set the download attribute with a default file name
                            link.download = filePath.split('/').pop();

                            // Append the link to the body (required for Firefox)
                            document.body.appendChild(link);

                            // Trigger the download
                            link.click();

                            // Remove the link after triggering the download
                            document.body.removeChild(link);
                        } else {
                            alert(data.error || 'An error occurred');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Please enter your username');
            }
        });
  