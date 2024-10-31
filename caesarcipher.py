def encrypt_caesar(plaintext, shift):
    encrypted_text = ""
    for char in plaintext:
        if char.isalpha():
            shift_amount = shift % 26
            shifted = ord(char) + shift_amount
            if char.islower():
                if shifted > ord('z'):
                    shifted -= 26
                encrypted_text += chr(shifted)
            elif char.isupper():
                if shifted > ord('Z'):
                    shifted -= 26
                encrypted_text += chr(shifted)
        else:
            encrypted_text += char
    return encrypted_text

def decrypt_caesar(ciphertext, shift):
    return encrypt_caesar(ciphertext, -shift)

def brute_force_caesar(ciphertext):
    for shift in range(26):
        decrypted_text = decrypt_caesar(ciphertext, shift)
        print(f"Shift {shift}: {decrypted_text}")

def main():
    while True:
        print("\nCaesar Cipher Menu:")
        print("1: Encrypt")
        print("2: Solve")
        print("3: Exit")
        
        choice = input("Select option: ")

        if choice == '1':
            plaintext = input("Input text: ")
            shift = int(input("Input shift value: "))
            encrypted = encrypt_caesar(plaintext, shift)
            print(f"Result: {encrypted}")

        elif choice == '2':
            ciphertext = input("Input encrypted text: ")
            print("Solving Encryption...")
            brute_force_caesar(ciphertext)

        elif choice == '3':
            print("Thank you for using Caesar Cipher. Goodbye!")
            break

        else:
            print("Not valid. Please select 1, 2, or 3.")

if __name__ == "__main__":
    main()