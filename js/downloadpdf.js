document.getElementById('downloadBtn').addEventListener('click', function() {
    // Define the file path
    const filePathfitness = '../localhost/php/fitness_form/.pdf'; // Replace with your actual file path
    const filePathadhar = '../localhost/php/adhar_card/.pdf'; // Replace with your actual file path
    // Create an anchor element
    const link = document.createElement('a');
    link.href = filePathfitness;
    link.href = filePathadhar;
    // Set the download attribute with a default file name
    link.download = filePath.split('/').pop();

    // Append the link to the body (required for Firefox)
    document.body.appendChild(link);

    // Trigger the download
    link.click();

    // Remove the link after triggering the download
    document.body.removeChild(link);
});
