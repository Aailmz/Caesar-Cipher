package main

import (
	"bufio"
	"fmt"
	"os"
	"strings"
)

func encryptCaesar(plaintext string, shift int) string {
	var encryptedText strings.Builder
	shift = shift % 26

	for _, char := range plaintext {
		if char >= 'a' && char <= 'z' {
			shifted := char + rune(shift)
			if shifted > 'z' {
				shifted -= 26
			}
			if shifted < 'a' {
				shifted += 26
			}
			encryptedText.WriteRune(shifted)
		} else if char >= 'A' && char <= 'Z' {
			shifted := char + rune(shift)
			if shifted > 'Z' {
				shifted -= 26
			}
			if shifted < 'A' {
				shifted += 26
			}
			encryptedText.WriteRune(shifted)
		} else {
			encryptedText.WriteRune(char)
		}
	}

	return encryptedText.String()
}

func decryptCaesar(ciphertext string, shift int) string {
	return encryptCaesar(ciphertext, -shift)
}

func bruteForceCaesar(ciphertext string) {
	for shift := 0; shift < 26; shift++ {
		decryptedText := decryptCaesar(ciphertext, shift)
		fmt.Printf("Shift %d: %s\n", shift, decryptedText)
	}
}

func main() {
	reader := bufio.NewReader(os.Stdin)

	fmt.Println("Select option (1: Encrypt, 2: Solve): ")
	choice, _ := reader.ReadString('\n')
	choice = strings.TrimSpace(choice)

	switch choice {
	case "1":
		fmt.Println("Input text: ")
		plaintext, _ := reader.ReadString('\n')
		plaintext = strings.TrimSpace(plaintext)

		fmt.Println("Input shift value: ")
		var shift int
		fmt.Scan(&shift)

		encrypted := encryptCaesar(plaintext, shift)
		fmt.Printf("Result: %s\n", encrypted)
	case "2":
		fmt.Println("Input encrypted text: ")
		ciphertext, _ := reader.ReadString('\n')
		ciphertext = strings.TrimSpace(ciphertext)

		fmt.Println("Solving Encryption...")
		bruteForceCaesar(ciphertext)
	default:
		fmt.Println("Not valid.")
	}
}
