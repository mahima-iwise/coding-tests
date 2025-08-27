/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx,html}",
    "./**/*.html"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Open Sans", "sans-serif"],
      },
       colors: {
        charcoal: "#2C2C2C",
        teal: "#0AB0BF",
        blue: "#0069CE",
        darkTeal: "#00838F",
        orange: "#FF8853",
      },
      fontSize: {
        h1: ["40px", { lineHeight: "48px", fontWeight: "400" }],
        h2: ["32px", { lineHeight: "48px", fontWeight: "400" }],
        h3: ["24px", { lineHeight: "32px", fontWeight: "600" }],
        h4: ["20px", { lineHeight: "28px", fontWeight: "600" }],
        body: ["16px", { lineHeight: "28px" }],
        link: ["16px", { lineHeight: "28px", fontWeight: "600" }],
      },
    },
  },
  plugins: [],
}