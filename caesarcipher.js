function encryptCaesar(plaintext, shift) {
    let encryptedText = "";
    for (let char of plaintext) {
        if (/[a-zA-Z]/.test(char)) {
            const shiftAmount = shift % 26;
            const charCode = char.charCodeAt(0);
            let shifted = charCode + shiftAmount;
            
            if (char.toLowerCase() === char) {  // lowercase
                if (shifted > 'z'.charCodeAt(0)) {
                    shifted -= 26;
                }
                if (shifted < 'a'.charCodeAt(0)) {
                    shifted += 26;
                }
            } else {  // uppercase
                if (shifted > 'Z'.charCodeAt(0)) {
                    shifted -= 26;
                }
                if (shifted < 'A'.charCodeAt(0)) {
                    shifted += 26;
                }
            }
            encryptedText += String.fromCharCode(shifted);
        } else {
            encryptedText += char;
        }
    }
    return encryptedText;
}

function decryptCaesar(ciphertext, shift) {
    return encryptCaesar(ciphertext, -shift);
}

function bruteForceCaesar(ciphertext) {
    for (let shift = 0; shift < 26; shift++) {
        const decryptedText = decryptCaesar(ciphertext, shift);
        console.log(`Shift ${shift}: ${decryptedText}`);
    }
}

// Using readline for command line interface
const readline = require('readline').createInterface({
    input: process.stdin,
    output: process.stdout
});

function main() {
    readline.question('Select option (1: Encrypt, 2: Solve): ', (choice) => {
        if (choice === '1') {
            readline.question('Input text: ', (plaintext) => {
                readline.question('Input shift value: ', (shift) => {
                    const encrypted = encryptCaesar(plaintext, parseInt(shift));
                    console.log(`Result: ${encrypted}`);
                    readline.close();
                });
            });
        } else if (choice === '2') {
            readline.question('Input encrypted text: ', (ciphertext) => {
                console.log('Solving Encryption...');
                bruteForceCaesar(ciphertext);
                readline.close();
            });
        } else {
            console.log('Not valid.');
            readline.close();
        }
    });
}

if (require.main === module) {
    main();
}

module.exports = {
    encryptCaesar,
    decryptCaesar,
    bruteForceCaesar
};
