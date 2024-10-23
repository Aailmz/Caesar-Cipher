<?php

//I'll use 3 menu in this one :P
function encryptCaesar($plaintext, $shift) {
    $encryptedText = "";
    $shift = $shift % 26; 
    
    for ($i = 0; $i < strlen($plaintext); $i++) {
        $char = $plaintext[$i];
        
        if (ctype_alpha($char)) {
            $charCode = ord($char);
            $shifted = $charCode + $shift;
            
            if (ctype_lower($char)) { 
                if ($shifted > ord('z')) {
                    $shifted -= 26;
                }
                if ($shifted < ord('a')) {
                    $shifted += 26;
                }
            } else { 
                if ($shifted > ord('Z')) {
                    $shifted -= 26;
                }
                if ($shifted < ord('A')) {
                    $shifted += 26;
                }
            }
            $encryptedText .= chr($shifted);
        } else {
            $encryptedText .= $char;
        }
    }
    return $encryptedText;
}

function decryptCaesar($ciphertext, $shift) {
    return encryptCaesar($ciphertext, -$shift);
}

function bruteForceCaesar($ciphertext) {
    $results = [];
    for ($shift = 0; $shift < 26; $shift++) {
        $decryptedText = decryptCaesar($ciphertext, $shift);
        $results[] = "Shift $shift: $decryptedText";
    }
    return $results;
}

function main() {
    while (true) {
        echo "Select option (1: Encrypt, 2: Solve, 3: Exit): ";
        $choice = trim(fgets(STDIN));
        
        switch ($choice) {
            case '1':
                echo "Input text: ";
                $plaintext = trim(fgets(STDIN));
                echo "Input shift value: ";
                $shift = (int)trim(fgets(STDIN));
                
                $encrypted = encryptCaesar($plaintext, $shift);
                echo "Result: $encrypted\n";
                break;
                
            case '2':
                echo "Input encrypted text: ";
                $ciphertext = trim(fgets(STDIN));
                echo "Solving Encryption...\n";
                
                $results = bruteForceCaesar($ciphertext);
                foreach ($results as $result) {
                    echo $result . "\n";
                }
                break;
                
            case '3':
                echo "Goodbye!\n";
                exit(0);
                
            default:
                echo "Not valid.\n";
        }
        
        echo "\n";
    }
}

if (php_sapi_name() === 'cli' && isset($argv[0]) && realpath($argv[0]) === realpath(__FILE__)) {
    main();
}

if (!defined('STDIN')) {
    return [
        'encryptCaesar' => 'encryptCaesar',
        'decryptCaesar' => 'decryptCaesar',
        'bruteForceCaesar' => 'bruteForceCaesar'
    ];
}