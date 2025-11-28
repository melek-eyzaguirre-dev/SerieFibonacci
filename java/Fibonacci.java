/**
 * Fibonacci Series Implementation in Java
 * Author: Portfolio Project
 * Description: Generates the Fibonacci sequence up to n terms
 */

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class Fibonacci {
    
    private Map<Integer, Long> memo = new HashMap<>();
    
    /**
     * Generate Fibonacci series using iterative approach
     * 
     * @param n Number of terms to generate
     * @return List containing the Fibonacci sequence
     */
    public List<Long> fibonacciIterative(int n) {
        List<Long> sequence = new ArrayList<>();
        
        if (n <= 0) {
            return sequence;
        }
        
        sequence.add(0L);
        if (n == 1) {
            return sequence;
        }
        
        sequence.add(1L);
        for (int i = 2; i < n; i++) {
            sequence.add(sequence.get(i - 1) + sequence.get(i - 2));
        }
        
        return sequence;
    }
    
    /**
     * Generate nth Fibonacci number using recursive approach with memoization
     * 
     * @param n The position in Fibonacci sequence (0-indexed)
     * @return The nth Fibonacci number
     */
    public long fibonacciRecursive(int n) {
        if (n <= 0) {
            return 0;
        }
        if (n == 1) {
            return 1;
        }
        
        if (memo.containsKey(n)) {
            return memo.get(n);
        }
        
        long result = fibonacciRecursive(n - 1) + fibonacciRecursive(n - 2);
        memo.put(n, result);
        return result;
    }
    
    /**
     * Generate Fibonacci series using dynamic programming
     * 
     * @param n Number of terms to generate
     * @return List containing the Fibonacci sequence
     */
    public List<Long> fibonacciDynamic(int n) {
        List<Long> sequence = new ArrayList<>();
        
        if (n <= 0) {
            return sequence;
        }
        
        long[] dp = new long[Math.max(2, n)];
        dp[0] = 0;
        dp[1] = 1;
        
        for (int i = 2; i < n; i++) {
            dp[i] = dp[i - 1] + dp[i - 2];
        }
        
        for (int i = 0; i < n; i++) {
            sequence.add(dp[i]);
        }
        
        return sequence;
    }
    
    /**
     * Get Fibonacci series using recursive method
     * 
     * @param n Number of terms
     * @return List of Fibonacci numbers
     */
    public List<Long> getRecursiveSeries(int n) {
        List<Long> sequence = new ArrayList<>();
        memo.clear();
        for (int i = 0; i < n; i++) {
            sequence.add(fibonacciRecursive(i));
        }
        return sequence;
    }
    
    public static void main(String[] args) {
        Fibonacci fib = new Fibonacci();
        int n = 10;
        
        System.out.println("Fibonacci Series (first " + n + " terms):");
        System.out.println("Iterative: " + fib.fibonacciIterative(n));
        System.out.println("Recursive: " + fib.getRecursiveSeries(n));
        System.out.println("Dynamic:   " + fib.fibonacciDynamic(n));
    }
}
