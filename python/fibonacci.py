"""
Fibonacci Series Implementation in Python
Author: Portfolio Project
Description: Generates the Fibonacci sequence up to n terms
"""


def fibonacci_iterative(n):
    """
    Generate Fibonacci series using iterative approach
    
    Args:
        n: Number of terms to generate
        
    Returns:
        List containing the Fibonacci sequence
    """
    if n <= 0:
        return []
    if n == 1:
        return [0]
    
    sequence = [0, 1]
    for i in range(2, n):
        sequence.append(sequence[i-1] + sequence[i-2])
    
    return sequence


def fibonacci_recursive(n, memo=None):
    """
    Generate nth Fibonacci number using recursive approach with memoization
    
    Args:
        n: The position in Fibonacci sequence (0-indexed)
        memo: Dictionary for memoization
        
    Returns:
        The nth Fibonacci number
    """
    if memo is None:
        memo = {}
    
    if n in memo:
        return memo[n]
    
    if n <= 0:
        return 0
    if n == 1:
        return 1
    
    memo[n] = fibonacci_recursive(n-1, memo) + fibonacci_recursive(n-2, memo)
    return memo[n]


def fibonacci_generator(n):
    """
    Generate Fibonacci series using a generator
    
    Args:
        n: Number of terms to generate
        
    Yields:
        Next Fibonacci number
    """
    a, b = 0, 1
    count = 0
    while count < n:
        yield a
        a, b = b, a + b
        count += 1


def get_fibonacci_series(n, method="iterative"):
    """
    Main function to get Fibonacci series
    
    Args:
        n: Number of terms
        method: Method to use ('iterative', 'recursive', 'generator')
        
    Returns:
        List of Fibonacci numbers
    """
    if method == "iterative":
        return fibonacci_iterative(n)
    elif method == "recursive":
        return [fibonacci_recursive(i) for i in range(n)]
    elif method == "generator":
        return list(fibonacci_generator(n))
    else:
        raise ValueError(f"Unknown method: {method}")


if __name__ == "__main__":
    # Demo
    n = 10
    print(f"Fibonacci Series (first {n} terms):")
    print(f"Iterative: {get_fibonacci_series(n, 'iterative')}")
    print(f"Recursive: {get_fibonacci_series(n, 'recursive')}")
    print(f"Generator: {get_fibonacci_series(n, 'generator')}")
