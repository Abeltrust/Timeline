import re

with open(r'c:\Timeline\resources\views\profile\settings.blade.php', 'r', encoding='utf-8') as f:
    t = f.read()

# Make sidebar and main content dark
t = re.sub(r'<aside class="([^"]+)">', r'<aside class="\1 dark:bg-stone-800 dark:border-stone-700">', t)
t = re.sub(r'<main class="([^"]+)">', r'<main class="\1 dark:bg-stone-800 dark:border-stone-700">', t)

# Fix text colors for text-gray-800 -> text-gray-800 dark:text-gray-100
t = t.replace('text-gray-800', 'text-gray-800 dark:text-gray-100')
t = t.replace('text-gray-700', 'text-gray-700 dark:text-gray-300')
t = t.replace('text-gray-600', 'text-gray-600 dark:text-gray-400')
t = t.replace('text-gray-500', 'text-gray-500 dark:text-gray-400')

# Fix bg-white inside inputs and labels
t = re.sub(r'class="w-full border rounded-lg p-2 mt-1"', r'class="w-full border dark:border-stone-600 dark:bg-stone-900 dark:text-gray-100 rounded-lg p-2 mt-1"', t)

with open(r'c:\Timeline\resources\views\profile\settings.blade.php', 'w', encoding='utf-8') as f:
    f.write(t)

print("Settings dark mode replaced successfully.")
