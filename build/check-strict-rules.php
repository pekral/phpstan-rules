<?php

declare(strict_types = 1);

// Path to vendor and phpstan.neon
$strictRulesDir = __DIR__ . '/../vendor/phpstan/phpstan-strict-rules/src/Rules';
$neonFile = __DIR__ . '/../phpstan.neon';

// Mapping from individual rules to group rules
$ruleMapping = [
    'ArrayFilterStrict' => 'strictArrayFilter',
    'BooleanInBooleanAnd' => 'booleansInConditions',
    'BooleanInBooleanNot' => 'booleansInConditions',
    'BooleanInBooleanOr' => 'booleansInConditions',
    'BooleanInDoWhileCondition' => 'booleansInLoopConditions',
    'BooleanInElseIfCondition' => 'booleansInConditions',

    // Boolean conditions
    'BooleanInIfCondition' => 'booleansInConditions',
    'BooleanInTernaryOperator' => 'booleansInConditions',
    'BooleanInWhileCondition' => 'booleansInLoopConditions',

    // Function rules
    'ClosureUsesThis' => 'closureUsesThis',
    'DisallowedBacktick' => 'disallowedBacktick',
    'DisallowedEmpty' => 'disallowedEmpty',
    'DisallowedImplicitArrayCreation' => 'disallowedImplicitArrayCreation',
    // Disallowed constructs
    'DisallowedLooseComparison' => 'disallowedLooseComparison',
    'DisallowedShortTernary' => 'disallowedShortTernary',

    // Dynamic calls
    'DynamicCallOnStaticMethods' => 'dynamicCallOnStaticMethod',
    'DynamicCallOnStaticMethodsCallable' => 'dynamicCallOnStaticMethod',
    'IllegalConstructorMethodCall' => 'illegalConstructorMethodCall',
    'IllegalConstructorStaticCall' => 'illegalConstructorMethodCall',

    // Switch conditions
    'MatchingTypeInSwitchCaseCondition' => 'switchConditionsMatchingType',
    'OperandInArithmeticIncrementOrDecrement' => 'numericOperandsInArithmeticOperators',
    'OperandInArithmeticPostDecrement' => 'numericOperandsInArithmeticOperators',
    'OperandInArithmeticPostIncrement' => 'numericOperandsInArithmeticOperators',
    'OperandInArithmeticPreDecrement' => 'numericOperandsInArithmeticOperators',

    // Arithmetic operators
    'OperandInArithmeticPreIncrement' => 'numericOperandsInArithmeticOperators',
    'OperandInArithmeticUnaryMinus' => 'numericOperandsInArithmeticOperators',
    'OperandInArithmeticUnaryPlus' => 'numericOperandsInArithmeticOperators',
    'OperandsInArithmeticAddition' => 'numericOperandsInArithmeticOperators',
    'OperandsInArithmeticDivision' => 'numericOperandsInArithmeticOperators',
    'OperandsInArithmeticExponentiation' => 'numericOperandsInArithmeticOperators',
    'OperandsInArithmeticModulo' => 'numericOperandsInArithmeticOperators',
    'OperandsInArithmeticMultiplication' => 'numericOperandsInArithmeticOperators',
    'OperandsInArithmeticSubtraction' => 'numericOperandsInArithmeticOperators',

    // Loop rules
    'OverwriteVariablesWithForeach' => 'overwriteVariablesWithLoop',
    'OverwriteVariablesWithForLoopInit' => 'overwriteVariablesWithLoop',

    // Constructor rules
    'RequireParentConstructCall' => 'requireParentConstructorCall',
    'StrictFunctionCalls' => 'strictFunctionCalls',

    // Cast rules
    'UselessCast' => 'uselessCast',
    'VariableMethodCall' => 'noVariableVariables',
    'VariableMethodCallable' => 'noVariableVariables',
    'VariablePropertyFetch' => 'noVariableVariables',
    'VariableStaticMethodCall' => 'noVariableVariables',
    'VariableStaticMethodCallable' => 'noVariableVariables',
    'VariableStaticPropertyFetch' => 'noVariableVariables',

    // Variable variables
    'VariableVariables' => 'noVariableVariables',

    // Method rules
    'WrongCaseOfInheritedMethod' => 'matchingInheritedMethodNames',
];

// 1. Get all individual rules from phpstan-strict-rules
function getStrictRuleNames(string $dir): array {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $rules = [];

    foreach ($rii as $file) {
        if (!$file instanceof SplFileInfo) {
            continue;
        }
        
        if ($file->isDir()) {
            continue;
        }

        $filename = $file->getFilename();

        if (substr($filename, -8) !== 'Rule.php') {
            continue;
        }

        // Example: DisallowedLooseComparisonRule.php => DisallowedLooseComparison
        $base = preg_replace('/Rule\\.php$/', '', $filename);
        $rules[] = $base;
    }

    return $rules;
}

// 2. Get group rules from phpstan.neon
function getStrictRulesFromNeon(string $neonFile): array {
    $content = file_get_contents($neonFile);

    if ($content === false)

    return [];

    $matches = [];

    if (preg_match('/strictRules:\s*([\s\S]+?)^\s*level:/m', $content, $matches) === 1) {
        $block = $matches[1];
        preg_match_all('/^\s*([a-zA-Z0-9_]+):/m', $block, $ruleMatches);

        return $ruleMatches[1];
    }

    return [];
}

$allIndividualRules = getStrictRuleNames($strictRulesDir);
$neonGroupRules = getStrictRulesFromNeon($neonFile);

// Check which individual rules are not covered by group rules
$missing = [];

foreach ($allIndividualRules as $individualRule) {
    if (!is_string($individualRule) || !isset($ruleMapping[$individualRule])) {
        // Skip unknown rules
        continue;
    }
    
    $groupRule = $ruleMapping[$individualRule];

    if (!in_array($groupRule, $neonGroupRules, true)) {
        $missing[] = $individualRule;
    }
}

if (count($missing) === 0) {
    echo "All strict rules from phpstan-strict-rules are defined in phpstan.neon!\n";
    exit(0);
}

foreach ($missing as $rule) {
    echo "$rule\n";
}

exit(1); 