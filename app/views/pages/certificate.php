<?php
require __DIR__ . '/../../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7fafc;
            padding: 20px;
        }
        .certificate-container {
            background-color: white;
            border: 8px double #4A5568;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .certificate-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .certificate-header h1 {
            font-size: 2.5em;
            color: #2D3748;
        }
        .certificate-header .line {
            width: 80px;
            height: 4px;
            background-color: #3182CE;
            margin: 10px auto;
        }
        .certificate-body {
            text-align: center;
            margin: 20px 0;
        }
        .certificate-body h2 {
            font-size: 2.5em;
            color: #2C5282;
        }
        .certificate-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-header">
            <h1>Certificate of Completion</h1>
            <div class="line"></div>
        </div>
        
        <div class="certificate-body">
            <p>This is to certify that</p>
            <h2>[Student Name]</h2>
            <p>has successfully completed the course</p>
            <h3>[Course Name]</h3>
            <p>with a grade of [Grade/Score]</p>
        </div>
        
        <div class="certificate-footer">
            <div>
                <div style="height: 1px; width: 100px; background-color: #E2E8F0;"></div>
                <p>Date Issued</p>
            </div>
            <div>
                <div style="height: 1px; width: 100px; background-color: #E2E8F0;"></div>
                <p>Instructor Signature</p>
            </div>
        </div>
        
        <div class="certificate-footer" style="margin-top: 30px;">
            <div>
                <p>Certificate ID: [UNIQUE-ID]</p>
            </div>
        </div>
    </div>
</body>
</html>
<?php
// $html = ob_get_clean();

// $dompdf->loadHtml($html);
// $dompdf->setPaper('A4', 'portrait');
// $dompdf->render();
// $dompdf->stream("certificate-of-completion.pdf", array("Attachment" => 1));
?>
