# Azera Lab v1.0

**Author :** Masoud Zohrabi ( <mdzzohrabi@gmail.com> )

[TOC]

##Case : Entity access performance

### Object Creation
Test                | Scale |       Time        | Memory
----------------|-------------|-------------|--------------------
Creation with instance       | 5000  |  0.3140869140625  |  112   
Creation with clone         | 5000  | 0.33392000198364  |  112   

### Column read
Test                | Scale |       Time        | Memory
----------------|-------------|-------------|--------------------
Get column by getter        | 10000 | 0.59601902961731  |  136   
Get column dynamic         | 10000 | 0.60775804519653  |  280   
Get column direct          | 10000 |  0.5257740020752  |  120   
Get column array          | 10000 | 0.52228784561157  |  112   

### Column set
Test                | Scale |       Time        | Memory
----------------|-------------|-------------|--------------------
Set column dynamicaly and validate | 10000 | 0.90060496330261  |  192   
Set column direct          | 10000 | 0.53503203392029  |  136   
Set column array          | 10000 | 0.53023481369019  |  112   
Set column by setter        | 10000 | 0.61148309707642  |  152   
Set column by setter and validate  | 10000 | 0.85791707038879  |  144   

### Search in rows
Test                | Scale |       Time        | Memory
----------------|-------------|-------------|--------------------
Search in entities dynamic var   |   1   | 0.094137907028198 |  120   
Search in entities static var    |   1   | 0.018819093704224 |  120  
Search in entities doctrine getter |   1   | 0.07529616355896  |  120   
Search in arrays          |   1   | 0.017956018447876 |  112   

### Result
Job | Array | Setter And Getter | Dynamic Column | Direct Column
----|-------|-------------------|----------------|----------------
Search ($10^4$ Rows) | 0.018 | 0.075 **(4x)** | 0.094 **(5.25x)** | 0.019 **(~1x)**
Set Value ($10^4$ times) | 0.530 | 0.857[^set_value] **(1.61x)** | 0.900 **(1.69x)**[^set_value] | 0.535 **(~1x)**
Get Value ($10^4$ times) | 0.522 | 0.596 **(1.14x)** | 0.607 **(1.16x)** | 0.525 **(~1x)**

[^set_value]: Validation does while setting value.