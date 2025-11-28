<?php
/**
 * Fibonacci Series Implementation in PHP
 * Author: Portfolio Project
 * Description: Generates the Fibonacci sequence up to n terms
 */

/**
 * Generate Fibonacci series using iterative approach
 * 
 * @param int $n Number of terms to generate
 * @return array Array containing the Fibonacci sequence
 */
function fibonacciIterative(int $n): array {
    if ($n <= 0) {
        return [];
    }
    if ($n === 1) {
        return [0];
    }
    
    $sequence = [0, 1];
    for ($i = 2; $i < $n; $i++) {
        $sequence[] = $sequence[$i - 1] + $sequence[$i - 2];
    }
    
    return $sequence;
}

/**
 * Generate nth Fibonacci number using recursive approach with memoization
 * 
 * @param int $n The position in Fibonacci sequence (0-indexed)
 * @param array &$memo Memoization cache
 * @return int The nth Fibonacci number
 */
function fibonacciRecursive(int $n, array &$memo = []): int {
    if (isset($memo[$n])) {
        return $memo[$n];
    }
    
    if ($n <= 0) {
        return 0;
    }
    if ($n === 1) {
        return 1;
    }
    
    $memo[$n] = fibonacciRecursive($n - 1, $memo) + fibonacciRecursive($n - 2, $memo);
    return $memo[$n];
}

/**
 * Generate Fibonacci series using generator function
 * 
 * @param int $n Number of terms to generate
 * @return Generator Yields next Fibonacci number
 */
function fibonacciGenerator(int $n): Generator {
    $a = 0;
    $b = 1;
    $count = 0;
    
    while ($count < $n) {
        yield $a;
        $temp = $a;
        $a = $b;
        $b = $temp + $b;
        $count++;
    }
}

/**
 * Generate Fibonacci series using dynamic programming
 * 
 * @param int $n Number of terms to generate
 * @return array Array containing the Fibonacci sequence
 */
function fibonacciDynamic(int $n): array {
    if ($n <= 0) {
        return [];
    }
    
    $dp = array_fill(0, max(2, $n), 0);
    $dp[0] = 0;
    $dp[1] = 1;
    
    for ($i = 2; $i < $n; $i++) {
        $dp[$i] = $dp[$i - 1] + $dp[$i - 2];
    }
    
    return array_slice($dp, 0, $n);
}

/**
 * Main function to get Fibonacci series
 * 
 * @param int $n Number of terms
 * @param string $method Method to use ('iterative', 'recursive', 'generator', 'dynamic')
 * @return array Array of Fibonacci numbers
 */
function getFibonacciSeries(int $n, string $method = 'iterative'): array {
    switch ($method) {
        case 'iterative':
            return fibonacciIterative($n);
        case 'recursive':
            $memo = [];
            $result = [];
            for ($i = 0; $i < $n; $i++) {
                $result[] = fibonacciRecursive($i, $memo);
            }
            return $result;
        case 'generator':
            return iterator_to_array(fibonacciGenerator($n));
        case 'dynamic':
            return fibonacciDynamic($n);
        default:
            throw new InvalidArgumentException("Unknown method: $method");
    }
}

// Demo (only runs when executed directly)
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'] ?? '')) {
    $n = 10;
    echo "Fibonacci Series (first $n terms):\n";
    echo "Iterative: [" . implode(", ", getFibonacciSeries($n, 'iterative')) . "]\n";
    echo "Recursive: [" . implode(", ", getFibonacciSeries($n, 'recursive')) . "]\n";
    echo "Generator: [" . implode(", ", getFibonacciSeries($n, 'generator')) . "]\n";
    echo "Dynamic:   [" . implode(", ", getFibonacciSeries($n, 'dynamic')) . "]\n";
}
?>
