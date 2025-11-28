/**
 * Fibonacci Series Implementation in C#
 * Author: Portfolio Project
 * Description: Generates the Fibonacci sequence up to n terms
 */

using System;
using System.Collections.Generic;

namespace FibonacciSeries
{
    public class Fibonacci
    {
        private Dictionary<int, long> memo = new Dictionary<int, long>();

        /// <summary>
        /// Generate Fibonacci series using iterative approach
        /// </summary>
        /// <param name="n">Number of terms to generate</param>
        /// <returns>List containing the Fibonacci sequence</returns>
        public List<long> FibonacciIterative(int n)
        {
            var sequence = new List<long>();

            if (n <= 0)
                return sequence;

            sequence.Add(0);
            if (n == 1)
                return sequence;

            sequence.Add(1);
            for (int i = 2; i < n; i++)
            {
                sequence.Add(sequence[i - 1] + sequence[i - 2]);
            }

            return sequence;
        }

        /// <summary>
        /// Generate nth Fibonacci number using recursive approach with memoization
        /// </summary>
        /// <param name="n">The position in Fibonacci sequence (0-indexed)</param>
        /// <returns>The nth Fibonacci number</returns>
        public long FibonacciRecursive(int n)
        {
            if (n <= 0)
                return 0;
            if (n == 1)
                return 1;

            if (memo.ContainsKey(n))
                return memo[n];

            long result = FibonacciRecursive(n - 1) + FibonacciRecursive(n - 2);
            memo[n] = result;
            return result;
        }

        /// <summary>
        /// Generate Fibonacci series using dynamic programming
        /// </summary>
        /// <param name="n">Number of terms to generate</param>
        /// <returns>List containing the Fibonacci sequence</returns>
        public List<long> FibonacciDynamic(int n)
        {
            var sequence = new List<long>();

            if (n <= 0)
                return sequence;

            long[] dp = new long[Math.Max(2, n)];
            dp[0] = 0;
            dp[1] = 1;

            for (int i = 2; i < n; i++)
            {
                dp[i] = dp[i - 1] + dp[i - 2];
            }

            for (int i = 0; i < n; i++)
            {
                sequence.Add(dp[i]);
            }

            return sequence;
        }

        /// <summary>
        /// Generate Fibonacci series using yield return (generator pattern)
        /// </summary>
        /// <param name="n">Number of terms to generate</param>
        /// <returns>IEnumerable of Fibonacci numbers</returns>
        public IEnumerable<long> FibonacciGenerator(int n)
        {
            long a = 0, b = 1;
            int count = 0;

            while (count < n)
            {
                yield return a;
                long temp = a;
                a = b;
                b = temp + b;
                count++;
            }
        }

        /// <summary>
        /// Get Fibonacci series using recursive method
        /// </summary>
        /// <param name="n">Number of terms</param>
        /// <returns>List of Fibonacci numbers</returns>
        public List<long> GetRecursiveSeries(int n)
        {
            var sequence = new List<long>();
            memo.Clear();
            for (int i = 0; i < n; i++)
            {
                sequence.Add(FibonacciRecursive(i));
            }
            return sequence;
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            var fib = new Fibonacci();
            int n = 10;

            Console.WriteLine($"Fibonacci Series (first {n} terms):");
            Console.WriteLine($"Iterative: [{string.Join(", ", fib.FibonacciIterative(n))}]");
            Console.WriteLine($"Recursive: [{string.Join(", ", fib.GetRecursiveSeries(n))}]");
            Console.WriteLine($"Dynamic:   [{string.Join(", ", fib.FibonacciDynamic(n))}]");
            Console.WriteLine($"Generator: [{string.Join(", ", fib.FibonacciGenerator(n))}]");
        }
    }
}
