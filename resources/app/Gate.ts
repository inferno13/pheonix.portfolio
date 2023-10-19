type User = {
  id: number
  name: string
  type: string
  email: string
  email_verified_at: string
}

export default class Gate {
  user: User
  constructor() {
    this.user = (window as any).user
  }

  isAdmin() {
    return this.user.type === 'admin'
  }

  isUser() {
    return this.user.type === 'user'
  }

  isAdminOrUser() {
    if (this.user.type === 'user' || this.user.type === 'admin') {
      return true
    }
  }
}
