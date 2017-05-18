/*
 * bst.h
 *
 */

#ifndef BST_H
#define BST_H

#include "bt.h"

template <typename T, typename K> class BST : public BT<T,K>
{
  public:
    virtual BT<T,K>* search(const K& k);
    virtual BT<T,K>* find_min();
    virtual void insert(const T& x, const K& k);
    virtual void remove(const K& k); 
    virtual void print(int depth = 0) const;

    virtual void iterator_init();
    virtual bool iterator_end();
    virtual T& iterator_next();

    typedef typename BT<T,K>::node bt_node;
};



/* Goal: Print the tree in a readable tree format
 * Remark: The output is the tree that is rotated -90 degrees.
 *         For each node only print its key value.
 */
template <typename T, typename K>
void BST<T,K>::print(int depth) const
{
    if (this->is_empty()) // Base case
       return;

    if (this->right_subtree())
        this->right_subtree()->print(depth+1); // Recursion: right subtree

    if (depth == 0)
        cout << "[Root] ";

    for (int j = 0; j < depth; j++) // Print the node value
        cout << "\t\t";
    cout << this->root->key << endl;

    if (this->left_subtree())
        this->left_subtree()->print(depth+1); // Recursion: left subtree
}

#include "bst.cpp"


#endif /* BST_H */
