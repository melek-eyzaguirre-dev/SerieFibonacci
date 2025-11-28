/**
 * Fibonacci Series Implementation in JavaScript
 * Author: Portfolio Project
 * Description: Generates the Fibonacci sequence up to n terms
 */

/**
 * Generate Fibonacci series using iterative approach
 * @param {number} n - Number of terms to generate
 * @returns {number[]} Array containing the Fibonacci sequence
 */
function fibonacciIterative(n) {
    if (n <= 0) return [];
    if (n === 1) return [0];
    
    const sequence = [0, 1];
    for (let i = 2; i < n; i++) {
        sequence.push(sequence[i - 1] + sequence[i - 2]);
    }
    
    return sequence;
}

/**
 * Generate nth Fibonacci number using recursive approach with memoization
 * @param {number} n - The position in Fibonacci sequence (0-indexed)
 * @param {Object} memo - Memoization cache
 * @returns {number} The nth Fibonacci number
 */
function fibonacciRecursive(n, memo = {}) {
    if (n in memo) return memo[n];
    if (n <= 0) return 0;
    if (n === 1) return 1;
    
    memo[n] = fibonacciRecursive(n - 1, memo) + fibonacciRecursive(n - 2, memo);
    return memo[n];
}

/**
 * Generate Fibonacci series using generator function
 * @param {number} n - Number of terms to generate
 * @yields {number} Next Fibonacci number
 */
function* fibonacciGenerator(n) {
    let a = 0, b = 1;
    let count = 0;
    
    while (count < n) {
        yield a;
        [a, b] = [b, a + b];
        count++;
    }
}

/**
 * Generate Fibonacci series using array reduce
 * @param {number} n - Number of terms to generate
 * @returns {number[]} Array containing the Fibonacci sequence
 */
function fibonacciReduce(n) {
    if (n <= 0) return [];
    if (n === 1) return [0];
    
    return Array(n - 2)
        .fill(0)
        .reduce(
            (acc) => {
                acc.push(acc[acc.length - 1] + acc[acc.length - 2]);
                return acc;
            },
            [0, 1]
        );
}

/**
 * Main function to get Fibonacci series
 * @param {number} n - Number of terms
 * @param {string} method - Method to use ('iterative', 'recursive', 'generator', 'reduce')
 * @returns {number[]} Array of Fibonacci numbers
 */
function getFibonacciSeries(n, method = 'iterative') {
    switch (method) {
        case 'iterative':
            return fibonacciIterative(n);
        case 'recursive':
            const memo = {};
            return Array.from({ length: n }, (_, i) => fibonacciRecursive(i, memo));
        case 'generator':
            return [...fibonacciGenerator(n)];
        case 'reduce':
            return fibonacciReduce(n);
        default:
            throw new Error(`Unknown method: ${method}`);
    }
}

// Export for Node.js
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        fibonacciIterative,
        fibonacciRecursive,
        fibonacciGenerator,
        fibonacciReduce,
        getFibonacciSeries
    };
}

// Demo (only runs in Node.js)
if (typeof require !== 'undefined' && require.main === module) {
    const n = 10;
    console.log(`Fibonacci Series (first ${n} terms):`);
    console.log(`Iterative: ${getFibonacciSeries(n, 'iterative')}`);
    console.log(`Recursive: ${getFibonacciSeries(n, 'recursive')}`);
    console.log(`Generator: ${getFibonacciSeries(n, 'generator')}`);
    console.log(`Reduce:    ${getFibonacciSeries(n, 'reduce')}`);
}
