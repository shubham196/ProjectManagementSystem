const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

function withOpacityValue(variable) {
    return ({ opacityValue }) => {
        if (opacityValue === undefined) {
            return `rgb(var(${variable}))`
        }
        return `rgb(var(${variable}) / ${opacityValue})`
    }
}

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: {
                    '50':  withOpacityValue('--color-primary-50'),
                    '100': withOpacityValue('--color-primary-100'),
                    '200': withOpacityValue('--color-primary-200'),
                    '300': withOpacityValue('--color-primary-300'),
                    '400': withOpacityValue('--color-primary-400'),
                    '500': withOpacityValue('--color-primary-500'),
                    '600': withOpacityValue('--color-primary-600'),
                    '700': withOpacityValue('--color-primary-700'),
                    '800': withOpacityValue('--color-primary-800'),
                    '900': withOpacityValue('--color-primary-900')
                },
                secondary: {
                    50: "rgb(var(--theme-secondary-color-var-50) / <alpha-value>)",
                    100: "rgb(var(--theme-secondary-color-var-100) / <alpha-value>)",
                    200: "rgb(var(--theme-secondary-color-var-200) / <alpha-value>)",
                    300: "rgb(var(--theme-secondary-color-var-300) / <alpha-value>)",
                    400: "rgb(var(--theme-secondary-color-var-400) / <alpha-value>)",
                    500: "rgb(var(--theme-secondary-color-var-500) / <alpha-value>)",
                    600: "rgb(var(--theme-secondary-color-var-600) / <alpha-value>)",
                    700: "rgb(var(--theme-secondary-color-var-700) / <alpha-value>)",
                    800: "rgb(var(--theme-secondary-color-var-800) / <alpha-value>)",
                    900: "rgb(var(--theme-secondary-color-var-900) / <alpha-value>)",
                  },
                danger: colors.red,
                success: colors.green,
                warning: colors.amber,
            },
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}