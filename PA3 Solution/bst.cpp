/*
 * bst.cpp
 *
 */

#ifndef BST_CPP
#define BST_CPP


/* Goal: To search for an item x with key k from the BST tree
 * Return: A pointer to the subtree whose root node contains the item if found,
 *         otherwise a NULL pointer.
 */
template <typename T, typename K>
BT<T,K>* BST<T,K>::search(const K& k)
{
    if (this->is_empty())
        return NULL;

    else if (this->root->key == k)
        return this;
    
    else if (k < this->root->key)
        return (this->left_subtree()) ? this->left_subtree()->search(k) : NULL;

    else
        return (this->right_subtree()) ? this->right_subtree()->search(k) : NULL;
}


/* Goal: To find the minimum node stored in a BST tree.
 * Return: A pointer to the subtree whose root node contains the minimum key
 */
template <typename T, typename K>
BT<T,K>* BST<T,K>::find_min()
{
    if (this->is_empty()) // Item is not found; do nothing
        return NULL;
    
    if (this->left_subtree() == NULL)
        return this;
    
    else
        return this->left_subtree()->find_min();

}


/* Goal: To insert an item x with key k to a BST tree */
template <typename T, typename K>
void BST<T,K>::insert(const T& x, const K& k)
{
    if (this->is_empty())  // Find the spot
        this->root = new bt_node(x, k);

    else if (k < this->root->key)
    {
        if (!this->left_subtree()) // Create a BST node first
            this->left_subtree() = new BST;
        
        this->left_subtree()->insert(x, k);
    }

    else if (k > this->root->key)
    {
        if (!this->right_subtree()) // Create a BST node first
            this->right_subtree() = new BST;

        this->right_subtree()->insert(x, k);
    }
}

/* Goal: To remove an item with key k in a BST tree */
template <typename T, typename K>
void BST<T,K>::remove(const K& k)
{
    BST* bst = dynamic_cast<BST*>(search(k));

    if (!bst)           // Item is not found; do nothing
        return;

    BST* left_bst = dynamic_cast<BST*>(bst->left_subtree());
    BST* right_bst = dynamic_cast<BST*>(bst->right_subtree());

    if (left_bst && right_bst)    // Found node has 2 children
    {
        BST* min_bst = dynamic_cast<BST*>(right_bst->find_min());
        bst->root->key = min_bst->root->key;
        bst->root->value = min_bst->root->value;
        right_bst->remove(bst->root->key);
    }

    else // Found node has 0 or 1 child
    {
        // Save the root to delete first
        bt_node* deleting_node = bst->root;

        if (!left_bst && !right_bst) // Found node is a leaf
        {
            bst->root = NULL;
        }
        else if (!left_bst)
        {
            bst->root = right_bst->root;
            dynamic_cast<BST*>(deleting_node->right)->root = NULL;
        }
        else // (!right_bst)
        {
            bst->root = left_bst->root;
            dynamic_cast<BST*>(deleting_node->left)->root = NULL;
        }
        
        delete deleting_node;
    }
}



/* Clear the node stack and set current pointer to the root */
template<typename T, typename K>
void BST<T,K>::iterator_init()
{
    while (!this->istack.empty()) 
        this->istack.pop();

    this->current = this->root;
}

/* Check whether the next smallest node exists */
template<typename T, typename K>
bool BST<T,K>::iterator_end()
{
     return (this->current == NULL && this->istack.empty());
}

/* Return the value of next smallest node from the tree */
template<typename T, typename K>
T& BST<T,K>::iterator_next()
{
    // Push all the leftmost nodes onto the stack
    while (this->current != NULL)
    {
        this->istack.push(this->current);
        this->current = (this->current->left) ?
            dynamic_cast<BST*>(this->current->left)->root : NULL;
    }

    // The smallest item is now on the top of the stack
    this->current = this->istack.top();
    T& next_value = this->current->value;

    // Pop out the smallest item and set current to the next item
    this->istack.pop();
    this->current = (this->current->right) ?
        dynamic_cast<BST*>(this->current->right)->root : NULL;

    return next_value;
}

#endif /* BST_CPP */
