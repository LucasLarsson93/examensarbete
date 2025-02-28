import globals from "globals";
import pluginJs from "@eslint/js";

/** @type {import('eslint').Linter.Config[]} */
export default [
  {
    languageOptions: {
      globals: globals.browser,
      ecmaVersion: "latest",
      sourceType: "module",
    },
    rules: {
      "no-unused-vars": "error",  // Disallow unused variables
      "no-console": "warn",       // Warn for console logs
      "semi": ["error", "always"], // Require semicolons
      "quotes": ["error", "double"],
      "indent": ["error", 2]
    }
  },
  pluginJs.configs.recommended,
];
