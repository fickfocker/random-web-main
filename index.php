<?php
function randomColor() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

function randomSize($min, $max) {
    return mt_rand($min, $max);
}

function randomString($length) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+-=[]{}|;:,.<>?~';
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $str;
}

function randomPosition() {
    return [
        'x' => mt_rand(0, 1920),
        'y' => mt_rand(0, 1080)
    ];
}

$elements = [];
for ($i = 0; $i < mt_rand(250, 1000); $i++) { 
    $type = mt_rand(0, 3);
    $pos = randomPosition();
    $size = randomSize(20, 500); 
    $color = randomColor();
    
    switch ($type) {
        case 0: 
            $elements[] = [
                'type' => 'div',
                'content' => randomString(mt_rand(5, 50)),
                'x' => $pos['x'],
                'y' => $pos['y'],
                'width' => $size,
                'height' => $size / mt_rand(1, 5),
                'color' => $color,
                'bgColor' => randomColor(),
                'rotation' => mt_rand(-180, 180),
                'opacity' => mt_rand(20, 100) / 100,
                'borderWidth' => randomSize(1, 10)
            ];
            break;
        case 1: 
            $elements[] = [
                'type' => 'button',
                'content' => randomString(mt_rand(5, 30)),
                'x' => $pos['x'],
                'y' => $pos['y'],
                'width' => $size,
                'height' => $size / mt_rand(2, 6),
                'color' => $color,
                'bgColor' => randomColor(),
                'fontSize' => randomSize(10, 48),
                'borderRadius' => randomSize(0, 50)
            ];
            break;
        case 2: // Text
            $elements[] = [
                'type' => 'text',
                'content' => randomString(mt_rand(10, 100)),
                'x' => $pos['x'],
                'y' => $pos['y'],
                'size' => randomSize(8, 96),
                'color' => $color,
                'rotation' => mt_rand(-45, 45)
            ];
            break;
        case 3: 
            $elements[] = [
                'type' => 'image',
                'x' => $pos['x'],
                'y' => $pos['y'],
                'width' => $size,
                'height' => $size / mt_rand(1, 3),
                'rotation' => mt_rand(-90, 90),
                'opacity' => mt_rand(30, 100) / 100
            ];
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo randomString(20); ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(<?php echo mt_rand(0, 360); ?>deg, <?php echo randomColor(); ?>, <?php echo randomColor(); ?>);
            min-width: 1920px;
            min-height: 1080px;
            overflow: hidden;
            font-family: <?php echo mt_rand(0, 1) ? 'Arial, sans-serif' : 'Courier New, monospace'; ?>;
        }
        .element {
            position: absolute;
            user-select: none;
            transition: all <?php echo mt_rand(1, 5); ?>s;
        }
        .div-element {
            border: <?php echo randomSize(1, 15); ?>px <?php echo mt_rand(0, 1) ? 'solid' : 'dashed'; ?> <?php echo randomColor(); ?>;
            border-radius: <?php echo randomSize(0, 100); ?>px;
            padding: <?php echo randomSize(5, 30); ?>px;
            box-shadow: <?php echo randomSize(-20, 20); ?>px <?php echo randomSize(-20, 20); ?>px <?php echo randomSize(0, 20); ?>px <?php echo randomColor(); ?>;
        }
        .button-element {
            border: <?php echo randomSize(1, 10); ?>px solid <?php echo randomColor(); ?>;
            cursor: pointer;
            padding: <?php echo randomSize(5, 25); ?>px;
            text-shadow: <?php echo randomSize(-5, 5); ?>px <?php echo randomSize(-5, 5); ?>px <?php echo randomColor(); ?>;
        }
        .text-element {
            font-weight: <?php echo mt_rand(0, 1) ? 'bold' : 'normal'; ?>;
            text-transform: <?php echo mt_rand(0, 2) ? 'uppercase' : (mt_rand(0, 1) ? 'lowercase' : 'none'); ?>;
            text-decoration: <?php echo mt_rand(0, 1) ? 'underline' : 'none'; ?>;
        }
        .image-element {
            background: <?php echo randomColor(); ?>;
            border: <?php echo randomSize(1, 8); ?>px solid <?php echo randomColor(); ?>;
        }
    </style>
</head>
<body>
<?php foreach ($elements as $element): ?>
    <?php if ($element['type'] === 'div'): ?>
        <div class="element div-element" 
             style="left: <?php echo $element['x']; ?>px; 
                    top: <?php echo $element['y']; ?>px;
                    width: <?php echo $element['width']; ?>px;
                    height: <?php echo $element['height']; ?>px;
                    color: <?php echo $element['color']; ?>;
                    background: <?php echo $element['bgColor']; ?>;
                    transform: rotate(<?php echo $element['rotation']; ?>deg);
                    opacity: <?php echo $element['opacity']; ?>;
                    border-width: <?php echo $element['borderWidth']; ?>px;">
            <?php echo htmlspecialchars($element['content']); ?>
        </div>
    <?php elseif ($element['type'] === 'button'): ?>
        <button class="element button-element"
                style="left: <?php echo $element['x']; ?>px;
                       top: <?php echo $element['y']; ?>px;
                       width: <?php echo $element['width']; ?>px;
                       height: <?php echo $element['height']; ?>px;
                       color: <?php echo $element['color']; ?>;
                       background: <?php echo $element['bgColor']; ?>;
                       font-size: <?php echo $element['fontSize']; ?>px;
                       border-radius: <?php echo $element['borderRadius']; ?>px;">
            <?php echo htmlspecialchars($element['content']); ?>
        </button>
    <?php elseif ($element['type'] === 'text'): ?>
        <span class="element text-element"
              style="left: <?php echo $element['x']; ?>px;
                     top: <?php echo $element['y']; ?>px;
                     font-size: <?php echo $element['size']; ?>px;
                     color: <?php echo $element['color']; ?>;
                     transform: rotate(<?php echo $element['rotation']; ?>deg);">
            <?php echo htmlspecialchars($element['content']); ?>
        </span>
    <?php elseif ($element['type'] === 'image'): ?>
        <div class="element image-element"
             style="left: <?php echo $element['x']; ?>px;
                    top: <?php echo $element['y']; ?>px;
                    width: <?php echo $element['width']; ?>px;
                    height: <?php echo $element['height']; ?>px;
                    transform: rotate(<?php echo $element['rotation']; ?>deg);
                    opacity: <?php echo $element['opacity']; ?>;">
            <?php echo randomString(10); ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</body>
</html>