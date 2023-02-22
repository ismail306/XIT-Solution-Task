<?php
// Define the URL of the eCommerce website
$url = 'https://yourpetpa.com.au/';

// Send an HTTP GET request to the website and fetch the HTML response
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
));
$html = curl_exec($curl);
curl_close($curl);

// Parse the HTML response and extract the product items
$dom = new DOMDocument();
@$dom->loadHTML($html);
$productItems = $dom->getElementsByTagName('li');

// Extract the product attributes and store them in an array
$products = array();
if ($productItems->length > 0) {
    foreach ($productItems as $productItem) {
        $title = $productItem->getElementsByTagName('h3')[0]->nodeValue ?? '';
        $description = $productItem->getElementsByTagName('p')[0]->nodeValue ?? '';
        $category = $productItem->getElementsByTagName('span')[0]->nodeValue ?? '';
        $price = $productItem->getElementsByTagName('span')[1]->nodeValue ?? '';
        $productUrl = '';
        $imageUrl = '';
        if ($productItem->getElementsByTagName('a')->length > 0) {
            $productUrl = $productItem->getElementsByTagName('a')[0]->getAttribute('href');
        }
        if ($productItem->getElementsByTagName('img')->length > 0) {
            $imageUrl = $productItem->getElementsByTagName('img')[0]->getAttribute('src');
        }

        $product = array(
            'Title' => $title,
            'Description' => $description,
            'Category' => $category,
            'Price' => $price,
            'Product URL' => $productUrl,
            'Image URL' => $imageUrl
        );

        $products[] = $product;
    }
}

// Write the product attributes to a CSV file
$fp = fopen('datafeed.csv', 'w');
fputcsv($fp, array_keys($products[0]));
foreach ($products as $product) {
    fputcsv($fp, $product);
}
fclose($fp);
echo 'CSV file generated successfully.';
