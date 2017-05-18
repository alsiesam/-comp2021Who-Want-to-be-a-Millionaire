/*
 * avl.h
 */

#ifndef AVL_H
#define AVL_H

#include "bst.h"

template <typename T, typename K> class AVL : public BST<T,K>
{
  private:
    int bfactor() const;     // Find the balance factor of tree
    void fix_height() const; // Rectify the height of each node in tree
    void rotate_left();      // Single left or anti-clockwise rotation
    void rotate_right();     // Single right or clockwise rotation
    void balance();          // AVL tree balancing

  public:
    virtual void insert(const T& x, const K&k); // Insert an item in sorted order
    virtual void remove(const K& k);            // Remove an item

    typedef typename BT<T,K>::node bt_node;
};

#include "avl.cpp"


#endif /* AVL_H */
