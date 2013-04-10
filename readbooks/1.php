<?php 

# Step 1: Create a function that states the code intention

public function toggleReadBooks($guids, $user)
{
    if ($user instanceof UserInterface) {
        if (method_exists($user, 'getReadBooks')) {
            // we remove the temporal variable  $alreadyReadBooks
            // we introduce a new function to clean the code
            // we stop overwriting the $guid variable (NO STATE MODIFICATION)
            // the function name states the code intention
            $filteredGuids = filter_read_books($guids, $user->getReadBooks());

            if (!empty($filteredGuids)) {
                $userData = $this->readBooksById($filteredGuids, $user);

                if (!empty($userData)) {
                    $user->fromArray($userData);
                }
            }
        }
    }
}

function filter_read_books($guids, $alreadyReadBooks) {
    return array_filter($guids, function($guid) use ($alreadyReadBooks) {
            return !in_array($guid, $alreadyReadBooks);
        });
}