export const getTypeColor = (type) => {
  if (type === 'deposit') {
    return 'success'
  }
  if (type === 'withdraw') {
    return 'danger'
  }
  if (type === 'transfer') {
    return 'warning'
  }
  return 'success'
}

export const getStatusColor = (status) => {
  if (status === 'completed') {
    return 'success'
  }

  if (status === 'pending') {
    return 'info'
  }
  return 'danger'
}

export const getBooleanText = (val) => {
  if (val) {
    return 'utils.yes'
  }
  return 'utils.no'
}

export const getBooleanColor = (val) => {
  if (val) {
    return 'success'
  }
  return 'danger'
}
