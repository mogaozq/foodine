<?php
$uploadErrors = array();
if (isset($_FILES['uploadedFile'])) {
    $imageBox = $_FILES['uploadedFile'];
    $imgIsValid = validateImage($imageBox);
    if ($imgIsValid && empty($uploadErrors)) {
        $imageName = $imageBox['name'];
        $thumbnailAddress = "../images/foodsThumbnail/" . $imageName;
        saveImageThumbnail($imageBox,$thumbnailAddress, 200, 200);
        $mainImageAddress = "../images/foods/" . $imageName;
        saveImageThumbnail($imageBox,$mainImageAddress, 600, 600);
    } else {
        die(var_dump($uploadErrors));
    }
}
?>
    <form enctype="multipart/form-data" action="upload.php" method="post">
        <input type="file" name="uploadedFile"/>
        <input type="submit" value="upload">
    </form>
<?php
function validateImage($image)
{
    global $uploadErrors;
    $error = $image['error'];
    $mimeType = $image['type'];//image/jpeg
    $size = $image['size'];
    if (!$error) {
        if ($size != 0) {
            $type = explode("/", $mimeType)[0];
            if ($type == "image") {
                return true;
            } else {
                $uploadErrors[] = "uploaded file is not an image";
            }
//
        } else {
            $uploadErrors[] = "uploaded file size is 0";
        }

    } else {
        $uploadErrors[] = "file uploaded unseccessfully";
    }

    return false;
}

function saveImageThumbnail($imageBox, $address, $nearbyX, $nearbyY)
{
    $mimeType = $imageBox['type'];
    $imageAddress = $imageBox['tmp_name'];
    $type = explode("/", $mimeType)[1];
    $mainImage = ("imagecreatefrom" . $type)($imageAddress);
    $imageX = imagesx($mainImage);
    $imageY = imagesy($mainImage);
    setThumbnailSize($thumbX, $thumbY, $imageX, $imageY, $nearbyX, $nearbyY);// its cool thumbx is created automatically
    $thumbnail = imagecreatetruecolor($thumbX, $thumbY);
    imagecopyresampled($thumbnail, $mainImage, 0, 0, 0, 0, $thumbX, $thumbY, $imageX, $imageY);
    $isDone = ("image" . $type)($thumbnail, $address);
    if ($isDone) return true;
    else {
        global $uploadErrors;
        $uploadErrors[] = "thumbnail saving error";
        return false;
    }
}

function setThumbnailSize(&$thumbX, &$thumbY, $imageX, $imageY, $nearbyX, $nearbyY)
{
    $scailX = $imageX / $nearbyX;
    $scailY = $imageY / $nearbyY;
    $scail = ($scailX + $scailY) / 2;
    $thumbX = $imageX / $scail;
    $thumbY = $imageY / $scail;
}


