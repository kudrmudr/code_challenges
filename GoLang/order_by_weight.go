// The solution setup is where you can provide the candidate with the basic framework for their solution.
package main

import (
	"sort"
	"strconv"
	"strings"
)

func calcWeight(numStr string) int {
	weight := 0
	for _, digitStr := range numStr {
		digit, _ := strconv.Atoi(string(digitStr))
		weight = weight + digit
	}

	return weight
}

func compareStrings(strI string, strJ string) bool {
	wI := calcWeight(strI)
	wJ := calcWeight(strJ)

	if wI == wJ {
		return strI < strJ
	}

	return wI < wJ
}

func OrderByWeight(strn string) string {

	numbers := strings.Split(strn, " ")

	sort.SliceStable(numbers, func(i, j int) bool {
		return compareStrings(numbers[i], numbers[j])
	})

	return strings.Join(numbers, " ")
}

func main() {
	println(OrderByWeight("1 99 12 4"))
}
